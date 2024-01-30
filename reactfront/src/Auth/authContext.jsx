
import { createContext, useContext, useState,useEffect } from 'react';
import {login,register,logout,reset} from '../Api/api'

const AuthContext = createContext();

export const AuthProvider = ({ children }) => {
  
  //const [user, setUser] = useState([]);
  const [role, setRole] = useState('');
  const [authenticated, setAuthenticated] = useState(false);

  useEffect(() => {
    checkAuthentication();
  },[]);

  const checkAuthentication = () => {
    if(localStorage.getItem("token")){
      setAuthenticated(true);
      setRole(localStorage.getItem("role"));
    }
    setRole("no role");
  };



  return (
    <AuthContext.Provider value={{authenticated,role}}>
      {children}
    </AuthContext.Provider>
  );
};

export const useAuth = () => {
  return useContext(AuthContext);
};
