
import React from 'react';
import { useAuth } from '../Auth/authContext';
import { deleteRealEstate, updateApiRealEstate, updateRealEstate } from '../Api/api';
import { MdFavoriteBorder,MdFavorite } from "react-icons/md";
import useFavorites from '../Favorites/favorites';

const RealEstate = ({ realEstate }) => {

  const {authenticated,role} = useAuth();

  const {
    id,
    username,
    profile_picture_url,
    description,
    location,
    follows_count,
    followers_count,
    price,
  } = realEstate;

  const [isFavorite,toggleFavorite] = useFavorites(id);

  const handleDelete = (id) =>{
    deleteRealEstate(id).then(()=> window.location.reload());
  }

  const handleUpdate = (id,price,location) =>{
    updateRealEstate(id,price,location).then(()=> window.location.reload());
  }

  const handleUpdateApi = (id)=>{
    updateApiRealEstate(id).then(()=> window.location.reload());
  }

  const renderContent = () =>{
    if (!authenticated) {
      return (<>
        <h2>{username}'s Real Estate</h2>
        <img src={profile_picture_url} alt={`${username}'s profile`} style={{ maxWidth: '200px' }} />
        <p>Description: {description}</p>
        <p>Follows: {follows_count}</p>
        <p>Followers: {followers_count}</p>
        <p>Price: ${price}</p>
        <p>Location: {location}</p>
      </>);
    }
    
    if (role === "admin") {
      return (<>
        <h2>{username}'s Real Estate</h2>
        <img src={profile_picture_url} alt={`${username}'s profile`} style={{ maxWidth: '200px' }} />
        <p>Description: {description}</p>
        <p>Follows: {follows_count}</p>
        <p>Followers: {followers_count}</p>
        <p>Price: ${price}</p>
        <p>Location: {location}</p>
        <button onClick={()=>handleDelete(id)}>Delete</button>
        <span onClick={toggleFavorite}>
          {isFavorite ? <MdFavorite size={30}/> :<MdFavoriteBorder size={30}/> }
        </span>
      </>);
    }
  
    return (
      <>
        <h2>{username}'s Real Estate</h2>
        <img src={profile_picture_url} alt={`${username}'s profile`} style={{ maxWidth: '200px' }} />
        <p>Description: {description}</p>
        <p>Follows: {follows_count}</p>
        <p>Followers: {followers_count}</p>
        <p>Price: ${price}</p>
        <p>Location: {location}</p>
        <span onClick={toggleFavorite}>
          {isFavorite ? <MdFavorite size={30}/> :<MdFavoriteBorder size={30}/> }
        </span>
      </>
    );
  }

  return <div className="outer-wrapper">{renderContent()}</div>;
};

export default RealEstate;
