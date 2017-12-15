import * as React from 'react';
import '../App.css';
import {Welcome, MyComp} from './Welcome';

const logo = require('../logo.svg');

class App extends React.Component {
  render() {
    return (
        <div className="App">
            <div className="App-header">
                <img src={logo} className="App-logo" alt="logo" />
                <div id="clock" />
                <h2>Welcome to React</h2>
            </div>

            <p className="App-intro">
                Welcome to trender app
            </p>

            <MyComp />
            <Welcome name="ayrton" />
            <Welcome name="jonh" />
            <Welcome name="kelly" />
        </div>
    );
  }
}

export default App;
