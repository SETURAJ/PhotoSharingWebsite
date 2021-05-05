<style type="text/css">
body {
    margin: 0;
    padding: 0;
    font-family: sans-serif;
    background-position: center center;
    background-repeat: no-repeat;
    background-size: cover;
    background-attachment: fixed;
  }
  .box {
    width: 300px;
    padding: 40px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: #e7e7e7;
    border-radius: 25px;
    text-align: center;
  }
  
  .box h1 {
    color: black;
    text-transform: uppercase;
    font-weight: 500;
  }
  
  .box input[type="text"],
  .box input[type="password"], .box input[type="email"] {
    border: 0;
    background: none;
    display: block;
    margin: 20px auto;
    text-align: center;
    border: 2px solid #3498db;
    padding: 14px 10px;
    width: 200px;
    outline: none;
    color: black;
    border-radius: 24px;
    transition: 0.25s;
  }
  
  .box input[type="text"]:focus,
  .box input[type="password"]:focus, .box input[type="email"]:focus {
    width: 280px;
    border-color: #2ecc71;
  }
  
  .box input[type="submit"] {
    border: 0;
    background: none;
    display: block;
    margin: 20px auto;
    text-align: center;
    border: 2px solid #2ecc71;
    padding: 14px 40px;
    outline: none;
    color: black;
    border-radius: 24px;
    transition: 0.25s;
    cursor: pointer;
  }
  
  .box input[type="submit"]:hover {
    font-size: 21px;
    background: #2ecc71;
  }
</style>