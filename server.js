var express = require('express');
var fs = require('fs');
var WebSocketClient = require('websocket').client;
var app = express();
_ = require('underscore');

function getData(){
    var client = new WebSocketClient();

    client.on('connectFailed', function(error) {
        console.log('Connect Error: ' + error.toString());
    });

    client.on('connect', function(connection) {
        console.log('WebSocket Client Connected');
        connection.on('error', function(error) {
            console.log("Connection Error: " + error.toString());
        });
        connection.on('close', function() {
            console.log('echo-protocol Connection Closed');
        });
        connection.on('message', function(message) {
            if (message.type === 'utf8') {
                var keys = _.keys(JSON.parse(message.utf8Data).features);
                var values = _.values(JSON.parse(message.utf8Data).features);
                appendToFile(values.toString() + '\n');
                console.log(keys.toString());
            }
        });

    });

    client.connect('ws://cloud.neurosteer.com:8080/v1/features/0006664E5C06/pull');
}


function appendToFile(msg){
    fs.appendFile('data.csv', msg, function (err) {
        if (err) throw err;
    });
}



getData();


app.get('/data', function (req, res) {
    fs.readFile('data.csv', function (err, data) {
        if (err) throw err;
        res.send(true);
    });

});

var server = app.listen(80, function () {
    var host = server.address().address;
    var port = server.address().port;

    console.log('Example app listening at http://%s:%s', host, port);
});
