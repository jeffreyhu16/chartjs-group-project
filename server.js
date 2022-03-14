const express = require('express');
const cors = require('cors');
const app = express();
require('dotenv').config();

app.use(express.json());
app.use(cors());
app.use((req, res, next) => {
    res.header("Access-Control-Allow-Origin", "*");
    res.header("Access-Control-Allow-Mehods", "GET, PUT, POST, DELETE");
    res.header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");
    next();
});

const MongoClient = require('mongodb').MongoClient;
// const { ServerApiVersion } = require('mongodb');
const connectionString = process.env.key

MongoClient.connect(connectionString, (err, client) => {
    
    if (err) throw err;
    console.log('mongoDB in running');
    // db.close()

    const db = client.db('fn101');
    const dataCollection = db.collection('carrier_analyses');

    app.get('/', (req, res) => {
        res.sendFile(__dirname + '/pie.html');
    });
    
    app.get('/carrier_analyses', (req, res) => {
            dataCollection.find().toArray((err, result) => {
                if (err) return console.log(err)
            // 顯示取得資料在頁面上
                res.send(result)
            })
        });
        
    

});



    



app.listen(3000, () => console.log('Listening on port 3000'));
