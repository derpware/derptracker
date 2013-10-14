var kue = require('kue')
    , jobs = kue.createQueue()
    , MongoClient = require('mongodb').MongoClient;


setInterval(function(){
    MongoClient.connect('mongodb://127.0.0.1:27017/derptracker', function(err, db) {
        if(err) throw err;
        var results;

        var collection = db.collection('user');

        var lastdate = new Date();
        lastdate.setMinutes(lastdate.getMinutes() - 10);

        collection.find().toArray(function(err, result) {
            result.forEach(function(item){
                // TODO: Check if job is already queued
                if (item.lastcheck <= lastdate) {
                    jobs.create('putio', {
                        title: item.username,
                        oauth: item.putio.oauth
                    }).save();
                    collection.update({"_id": item._id}, {$set: {"lastcheck": new Date().getTime()}}, function(){});
                }
            });
            db.close();
        });
    });
}, 1000);