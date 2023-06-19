<style>

@import url('https://fonts.googleapis.com/css2?family=MuseoModerno&display=swap');

@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@800&display=swap');

body {
  background-color: #2c3e50;
  margin: 0;
  padding: 0;
}
div {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
}

div h1.error {
  color: #95a5a6;
  font-size: 140px;
  margin-bottom: 0;
  margin-top: 10px;
  font-family: 'MuseoModerno', cursive;
}

div p {
  color: #bdc3c7;
  margin-top: 0;
  letter-spacing: .3em;
  font-size: 20px;
  font-family: 'MuseoModerno', cursive;
}

div h1.meme {
  display: inline-block;
/*   opacity: 0; */
  color: #fff;
  -webkit-text-stroke: 2.2px rgba(0,0,0,0.8);
  text-shadow: 2px 4px 2px rgba(0, 0, 0, 0.8);
  font-size: 33px;
  font-family: 'Poppins', sans-serif;
/*   animation: fade 1.5s ease-in-out 1s 1 forwards; */
}

@keyframes fade {
  from {
    margin: -300px;
  }

  to {
    margin: -50px;
    opacity: 1;
  }
}
</style>
<body>
  <div>
    <h1 class="error">400</h1>
    <p>Bad Request</p>
    <img
       src="/assets/img/ohno.gif"
       alt="Dio"/>
    <h1 class="meme">You've sent a bad request!</h1>
  </div>
</body>
