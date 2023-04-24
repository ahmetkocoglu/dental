import React from 'react';
import './App.css';
// ** Store Imports
import {store} from './store'
import {Provider} from 'react-redux'
// Import real axios client
import './service/index'
import Home from "./pages/Home";
import {Route, Routes} from "react-router-dom";
import Doctor from "./pages/Doctor";
import Treatment from "./pages/Treatment";
import Nav from "./nav";
import Clinic from "./pages/Clinic";
import Appointment from "./pages/Appointment";

function App() {

    return (
        <Provider store={store}>
            <div className="App">
                <header className="App-header">
                    <Nav/>
                    <Routes>
                        <Route path="/" element={<Home/>}/>
                        <Route path="/doctor" element={<Doctor/>}/>
                        <Route path="/treatment" element={<Treatment/>}/>
                        <Route path="/clinic" element={<Clinic/>}/>
                        <Route path="/appointment" element={<Appointment/>}/>
                    </Routes>
                </header>
            </div>
        </Provider>
    );
}

export default App;
