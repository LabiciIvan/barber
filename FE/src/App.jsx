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

          dispatch(setShops(detailsShop.data));
        }


      } catch (error) {
        console.log('Error API call: ', error);
      }
    })();

  }, [bearerToken]);


return (
  <div className="min-h-screen bg-slate-900 text-white p-6">
    <div className="max-w-5xl mx-auto">
      <div className="flex items-center justify-between mb-8">
        <h1 className="text-xl font-bold">Explore trusted barber and choose the perfect spot for your next fresh cut.</h1>
      </div>

      {shops && shops.length > 0 ? (
        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
          {shops.map((shop) => (
            <div
              key={shop.id}
              className="bg-slate-800 rounded-xl p-5 shadow-lg border border-slate-700 hover:border-slate-500 transition-colors"
            >
              <h2 className="text-xl font-semibold mb-2">{shop.name}</h2>
              <p className="text-slate-400 text-sm mb-1">{shop.email}</p>
              <p className="text-slate-400 text-sm">{shop.phone}</p>
            </div>
          ))}
        </div>
      ) : (
        <p className="text-slate-400 text-center mt-16">No shops available</p>
      )}
    </div>
  </div>
);
}
