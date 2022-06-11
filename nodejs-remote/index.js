const readline = require('readline');
const Net = require('net');
const {Encryptor} = require('node-laravel-encryptor');

console.log("Welcome to remote Taxi manager!\nPlease enter your commands.\n");

//region vpn
let encryptor = new Encryptor({
    key: 'qvwhYdxRRI+U1zovNzfJqa2SVi2ntnsvt3+z+n72W9U=',
});
const filterAndPrintDataFromServer = (chunk) => {
    let c = chunk.toString();
    console.log("Decrypting data from server : " + c);
    c = encryptor
        .decrypt(c);
    c = JSON.parse(c);
    if(c.error){
        console.log('\x1b[31m%s\x1b[0m', c.msg);
    }else{
        console.log('\x1b[36m%s\x1b[0m', c.msg);
    }
}

const filterDataToServer = (data) => {
    return encryptor
        .encryptSync(data);
}
//endregion

//region prompt
const rl = readline.createInterface({
    input: process.stdin,
    output: process.stdout
});
const prompt = () => {
    rl.question('> ', function (q) {
        client.write(filterDataToServer(q));
    });
}
//endregion

//region handle program close
rl.on('close', function () {
    console.log('\nHave a nice day.');
    process.exit(0);
});
//endregion

//region tcp client
const port = 3008;
const host = '127.0.0.1';
const client = new Net.Socket();
client.connect({ port: port, host: host }, function() {
    console.log('connection established');
    prompt();
});
client.on('data', function(chunk) {
    filterAndPrintDataFromServer(chunk.toString())
    prompt();
});
client.on('end', function() {
    console.log('Requested an end to the TCP connection');
});
//endregion
