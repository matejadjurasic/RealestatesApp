import logo from './logo.svg';
import './App.css';
import RealEstate from './RealEstates/realEstate';
import RealEstates from './RealEstates/realEstates';
import Navbar from './Navbar/navbar';
import Login from './Login/login';
import { useAuth } from './Auth/authContext';
import { createContext, useContext, useState,useEffect } from 'react';

function App() {

  const { authenticated, role,name } = useAuth();

  return (
    <div>
      {authenticated ? (
      <Navbar />):(
      <>
        <Login/>,
        <RealEstates />
      </>
      )}
    </div>
  );
}

export default App;
