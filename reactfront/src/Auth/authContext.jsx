
import { createContext, useContext, useState,useEffect } from 'react';

const AuthContext = createContext({
    authenticated: false,
    role: null,
    name: null,
});

export const AuthProvider = ({ children }) => {
  const [authenticated, setAuthenticated] = useState(false);  
  const [role, setRole] = useState();
  const [name, setName] = useState();

  useEffect(() => {
    checkAuthentication();
    }, []);

    const checkAuthentication = () => {
        if (localStorage.getItem("token")) {
            setAuthenticated(true);
            setRole(localStorage.getItem("tip"));
            setName(localStorage.getItem("name"));
        }
        setAuthenticated(true);
    };


  return (
    <AuthContext.Provider value={{ authenticated,role,name}}>
      {children}
    </AuthContext.Provider>
  );
};

export const useAuth = () => {
  return useContext(AuthContext);
};
