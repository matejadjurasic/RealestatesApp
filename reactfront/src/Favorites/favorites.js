import React from 'react'
import { useState,useEffect } from 'react'
import { addFavorite,removeFavorite,fetchFavorites,fetchAllFavorites } from '../Api/api';
import { useAuth } from '../Auth/authContext';

export const useFavorites = (realEstateId) => {

  const [favorites, setFavorites] = useState([]);
  const{authenticated} =useAuth();
 

  useEffect(()=>{
    const fetchFavoritesData = async () => {
      try {
        // Fetch favorites only if user is authenticated
        if (authenticated) {
          const data = await fetchAllFavorites();
          setFavorites(data);
        }
      } catch (error) {
        console.error('Error fetching favorites:', error);
        setFavorites([]);
      }
    };
  
    fetchFavoritesData();  
  },[authenticated]);

  const isFavorite = favorites.some((favorite)=> favorite.realestate_id === realEstateId);

  const toggleFavorite = async () => {
    try {
      if(isFavorite){
       const removedFavorites = await removeFavorite(realEstateId);
       setFavorites(removedFavorites);
      }else{
       const addedFavorites = await addFavorite(realEstateId);
       setFavorites(addedFavorites);
      }
      
    } catch (error) {
      console.log("error setting favorites");
    }
  }

  return [isFavorite,toggleFavorite];
}

export default useFavorites;