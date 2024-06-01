const { MongoClient } = require('mongodb');

async function main() {
    const client = new MongoClient('mongodb://127.0.0.1:27017/Student');
    try {
        await client.connect();
        console.log("Connected to MongoDB");
        const db = client.db();
        const collection = db.collection('Student'); // Specify the collection name

        const result = await collection.deleteMany({});
        console.log(`${result.deletedCount} documents deleted`);
    }
    catch (e) {
        console.error(e);
    }
    finally {
        await client.close();
    }
}
main().catch(console.error);