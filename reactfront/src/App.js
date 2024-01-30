import logo from './logo.svg';
import './App.css';
import RealEstate from './RealEstates/realEstate';
import RealEstates from './RealEstates/realEstates';
import Navbar from './Navbar/navbar';
import Login from './Login/login';
import { useAuth } from './Auth/authContext';
import { createContext, useContext, useState,useEffect } from 'react';
import { BrowserRouter as Router, Route, Routes,Navigate } from 'react-router-dom';
//import Register from './Register/register';
//import Logout from './Logout/logout';
import { AuthProvider } from './Auth/authContext';
import Logout from './Logout/logout';
import Register from './Register/register';

function App() {

  const { authenticated,role } = useAuth();

  return (
    <Router>
      <AuthProvider>
        <Routes>
          
          {/* Add more routes as needed */}
          <Route path="*" element={!authenticated ? <Navigate to="/" /> : null} />
          <Route path="/" element={[<Navbar/>,<RealEstates/>]} />
          <Route path="/login" element={!authenticated ? [<Navbar/>,<Login/>] : <Navigate to="/" />} />
          <Route path="/register" element={!authenticated ? [<Navbar/>,<Register/>] : <Navigate to="/" />} />
          
          

          {authenticated &&
            <>
              <Route path="/" element={[<Navbar/>,<RealEstates/>]} />
              <Route path="/logout" element={<Logout />} />
            </>
          }
        </Routes>
      </AuthProvider>
    </Router>
  );
}

export default App;
