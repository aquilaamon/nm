const express = require('express');
const path = require('path');
const unirest = require('unirest');
const app = express();

// Middleware to parse JSON and URL-encoded data
app.use(express.json());
app.use(express.urlencoded({ extended: true }));

// Serve static files from a directory
app.use(express.static('public'));

// Basic route that sends an index.html file as a response to GET requests
app.get('/', function(req, res) {
    res.sendFile(path.join(__dirname, 'funding.html'));
});

// Example POST route for /funding
app.post('/funding', (req, res) => {
    const { donationAmount, donorDetails } = req.body;
    console.log('Donation Amount:', donationAmount);
    console.log('Donor Details:', donorDetails);

    // Validate the donation amount
    if (donationAmount < 50) {
        return res.status(400).send('Minimum donation amount is 50 shillings.');
    }

    // For now, we'll just send a confirmation message back
    res.status(201).send('Donation received. Thank you!');
});

// Authorization Request in NodeJS
var authReq = unirest("GET", "https://sandbox.safaricom.co.ke/oauth/v1/generate");

authReq.query({
    "grant_type": "client_credentials"
});

authReq.headers({
    "Authorization": "Basic jmaxOvphr0yzMn8PLqPzxgwkXp0sd2t31qUWbo19VcNYsU0ywrjWHk0EM38rKjXeTwqmAJ+agg5cxFuqvK8s5YKVz3ymnXTfs9+b3IQSQeuJyP0iFzg5JS2+hiGGXlorIsthSNTw0qJhZEVtZoMoPoS44592QOa9EQsobdc+SbF3xJAUGaiiIJ9mirpwRsVghsAli0IL+HHRznEWTmIQZenl6OizAJwNyPwOKKCYRUrV2iPDp+e6lsl04UjSr5yrVGoS/i2QkPYAW90PfwRVzEctRKvnZN6Qd6Jx7dRIAre4U+h31q5RCXI2x/RTKa9NGrBID27Pw2StzOw3wz0zHQ=="
});

authReq.end(res => {
    if (res.error) {
        console.error('Authorization Error:', res.body);
        throw new Error(res.error);
    }
    console.log('Authorization Response:', res.body);
});

const PORT = process.env.PORT || 3000;
app.listen(PORT, () => {
    console.log(`Server is running on http://localhost:${PORT}`);
});




/*const express = require('express');
const mongoose = require('mongoose');
const bodyParser = require('body-parser');
const bcrypt = require('bcryptjs');
const jwt = require('jsonwebtoken');

const app = express();
const PORT = process.env.PORT || 3000;

// Body-parser middleware
app.use(bodyParser.json());

// MongoDB Connection
mongoose.connect('mongodb://localhost/newsDB', {
    useNewUrlParser: true,
    useUnifiedTopology: true
});

// News Article Schema
const newsSchema = new mongoose.Schema({
    title: String,
    content: String,
    date: { type: Date, default: Date.now }
});

const News = mongoose.model('News', newsSchema);

// User Schema for Admin
const userSchema = new mongoose.Schema({
    username: String,
    password: String
});

const User = mongoose.model('User', userSchema);

// Routes
app.post('/api/login', async (req, res) => {
    const { username, password } = req.body;
    const user = await User.findOne({ username });
    if (!user) {
        return res.status(404).send('User not found');
    }
    const isMatch = await bcrypt.compare(password, user.password);
    if (!isMatch) {
        return res.status(400).send('Invalid credentials');
    }
    const token = jwt.sign({ id: user._id }, 'your_jwt_secret');
    res.send({ token });
});

app.post('/api/news', async (req, res) => {
    const { title, content } = req.body;
    const news = new News({ title, content });
    await news.save();
    res.send(news);
});

app.delete('/api/news/:id', async (req, res) => {
    const { id } = req.params;
    await News.findByIdAndDelete(id);
    res.send({ message: 'Article deleted' });
});

app.get('/api/news', async (req, res) => {
    const news = await News.find().sort({ date: -1 }).limit(4);
    res.send(news);
});

// Start server
app.listen(PORT, () => {
    console.log(`Server running on port ${PORT}`);
});
*/