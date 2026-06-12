import { useEffect, useState } from 'react'
import { useSelector, useDispatch } from 'react-redux'
import userService from './services/userService';
import { selectBearerToken, selectUsers, setUser} from './reduxSlices/authSlice';
import shopService from './services/shopService';
import { selectorShops, setShops } from './reduxSlices/shopSlice';

export default function App() {
  const dispatch    = useDispatch();

  const bearerToken = useSelector(selectBearerToken);

  const user        = useSelector(selectUsers);

  const shops       = useSelector(selectorShops);


  useEffect(() => {
    (async () => {
      try {

        if (!user && bearerToken) {
          const details = await userService.show(bearerToken);

          dispatch(setUser(details.data));
        }

        if (!shops) {
          const detailsShop = await shopService.index();
          console.log("detailsShop:", detailsShop.data);

          dispatch(setShops(detailsShop.data));
        }


      } catch (error) {
        console.log('Error API call: ', error);
      }
    })();

  }, [bearerToken]);


  return (
    <div className="min-h-screen flex items-center justify-center bg-slate-900 text-white">
      <h1 className="text-4xl font-bold">Barber</h1>
      {
        user ?
        <h1 className="text-4xl font-bold">Hi, {user.name}</h1>
        :
        ''
      }

      {
        shops ? 
        <div>Have shops</div>
        :
        'No shops'
      }
      
    </div>
  )
}
