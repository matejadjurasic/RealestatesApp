import React from 'react'
import { useState,useEffect } from 'react'
import { addFavorite,removeFavorite,fetchFavorites } from '../Api/api';

export const useFavorites = (realEstateId) => {

  const [favorites, setFavorites] = useState([]);

  useEffect(()=>{

    const fetchFavoritesData = async () => {
      try {
        const favoritesData = await fetchFavorites();
        setFavorites(favoritesData);
      } catch (error) {
        console.log("error getting favorites data");
      }
    }

    fetchFavoritesData();
  },[]);

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