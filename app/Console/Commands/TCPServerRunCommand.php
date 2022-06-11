<?php

namespace App\Console\Commands;

class TCPServerRunCommand extends TaxiBaseCommand
{
    protected $taxi_command = "tcp:start";
    protected $taxi_command_description = "start remote management server";

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    private function filterDataPassingToClient($data){
        return encrypt($data);
    }

    private function filterDataFromClient($data){
        $this->warn("\nDecrypting data from client: ". $data);
        return decrypt($data, false);
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        echo "Server Started...";
        ob_implicit_flush();
        $server = socket_create(AF_INET, SOCK_STREAM, 0);
        try {
            socket_bind($server, "127.0.0.1", "3008");
        } catch (\Throwable $e) {
            $this->error($e->getMessage());
            exit(1);
        }
        socket_listen($server);
        socket_set_nonblock($server);
        $sockets = [];
        while (true) {
            if ($newsock = socket_accept($server)) {
                if (is_resource($newsock)) {
                    socket_set_nonblock($newsock);
                    $sockets[] = $newsock;
                }
            }
            foreach ($sockets as $socket) {
                $buffer = '';
                if ($read = @socket_read($socket, 2048)) {
                    $buffer .= $read;
                }
                if ($buffer) {
                    $buffer = $this->filterDataFromClient($buffer);
                    try {
                        \Artisan::call($buffer,['--no-interaction' => true]);
                        @socket_write($socket, $this->filterDataPassingToClient(json_encode([
                            "error" => 0,
                            "msg" => \Artisan::output()
                        ], JSON_THROW_ON_ERROR)));
                    } catch (\Throwable $e) {
                        @socket_write($socket, $this->filterDataPassingToClient(json_encode([
                            "error" => 1,
                            "msg" => $e->getMessage()
                        ], JSON_THROW_ON_ERROR)));
                    }
                }
            }
            sleep(0.001);
        }
        socket_close($server);
        return 0;
    }
}
