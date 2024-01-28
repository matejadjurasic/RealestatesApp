// src/AuthContext.js
import { createContext, useContext, useState } from 'react';

const AuthContext = createContext({
    authenticated: false,
    role: null,
});

export const AuthProvider = ({ children }) => {
  const [authenticated, setAuthenticated] = useState(false);  
  const [role, setRole] = useState();

  useEffect(() => {
    checkAuthentication();
    }, []);

    const checkAuthentication = () => {
        if (localStorage.getItem("token")) {
            setAuthenticated(true);
            setRole(localStorage.getItem("tip"));
        }
    };


  return (
    <AuthContext.Provider value={{ authenticated,role }}>
      {children}
    </AuthContext.Provider>
  );
};

export const useAuth = () => {
  return useContext(AuthContext);
};
