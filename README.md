# TCP

## Explaining

This project has a `php tcp sever` and a `nodejs tcp client`, the purpose of this project is to let the manager list information from this project remotely via a `VPN` end to end connection, so that the packets won't get intercepted on the way.

## Important Limitations

- Only list commands will work, not add commands, since you don't have access to input over php.

## Usage

1. Start server

```bash
php artisan taxi:tcp:start
```

2. Wait for Server Start

![](./screenshot/Screen%20Shot%201401-03-21%20at%2014.36.19.png)

3. cd to your `nodejs-remote` start client

```bash
cd ./nodejs-remote
node index.js
```

4. Write your command

![](./screenshot/Screen%20Shot%201401-03-21%20at%2014.38.24.png)
