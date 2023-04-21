import React from 'react';
import './App.css';
// ** Store Imports
import { store } from './store'
import { Provider } from 'react-redux'
// Import real axios client
import './service/index'
import Home from "./Home";

function App() {
  return (
      <Provider store={store}>
    <div className="App">
      <header className="App-header">
        <Home/>
      </header>
    </div>
      </Provider>
  );
}

export default App;
