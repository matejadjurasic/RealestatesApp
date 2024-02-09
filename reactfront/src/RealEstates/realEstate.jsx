
import React,{useState} from 'react';
import { useAuth } from '../Auth/authContext';
import { deleteRealEstate, updateApiRealEstate, updateRealEstate } from '../Api/api';
import { MdFavoriteBorder,MdFavorite } from "react-icons/md";
import { FcLikePlaceholder,FcLike } from "react-icons/fc";
import useFavorites from '../Favorites/favorites';
import './realEstates.css';

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

  const [rsPrice, setRsPrice] = useState(price);
  const [rsLocation, setRsLocation] = useState(location);
  

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
        <h2>{username}</h2>
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
        <h2>{username}</h2>
        <img src={profile_picture_url} alt={`${username}'s profile`} style={{ maxWidth: '200px' }} />
        <p>Description: {description}</p>
        <p>Follows: {follows_count}</p>
        <p>Followers: {followers_count}</p>
        <input type="text" defaultValue={price} onChange={(e) => setRsPrice(e.target.value )}/> 
        <input type="text" defaultValue={location} onChange={(e) => setRsLocation(e.target.value )}/>
        <button onClick={()=>handleUpdate(id,rsPrice,rsLocation)}>Update</button>
        <button onClick={()=>handleUpdateApi(id)}>UpdateAPI</button>
        <button onClick={()=>handleDelete(id)}>Delete</button>
        <span onClick={toggleFavorite}>
          {isFavorite ? <FcLike size={30}/> :<FcLikePlaceholder size={30}/> }
        </span>
      </>);
    }
  
    return (
      <>
        <h2>{username}</h2>
        <img src={profile_picture_url} alt={`${username}'s profile`} style={{ maxWidth: '200px' }} />
        <p>Description: {description}</p>
        <p>Follows: {follows_count}</p>
        <p>Followers: {followers_count}</p>
        <p>Price: ${price}</p>
        <p>Location: {location}</p>
        <span onClick={toggleFavorite}>
          {isFavorite ? <FcLike size={30}/> :<FcLikePlaceholder size={30}/> }
        </span>
      </>
    );
  }

  return <div className="outer-wrapper">{renderContent()}</div>;
};

export default RealEstate;
