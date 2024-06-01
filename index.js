const mongoose = require('mongoose');
const connectDB = require('./dbConnect');
const Blog = require('./blog.js');
connectDB();
mongoose.connection.once('open', () => {
    console.log("Connected to MongoDB");
})
async function myFunction() {
    const article = await Blog.create({
        title: 'Awesome Post!',
        slug: 'awesome-post',
        published: true,
        content: 'This is the best post ever!!',
        tags: ['featured', 'announcement'],
    });
    console.log(article);
}
myFunction(); 
