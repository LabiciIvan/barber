import { useEffect } from "react";
import { useDispatch, useSelector } from "react-redux";
import { selectBearerToken, selectUsers, setUser } from "../reduxSlices/authSlice";
import { selectorShops, setShops } from "../reduxSlices/shopSlice";
import userService from "../services/userService";
import shopService from "../services/shopService";
import { useNavigate } from "react-router-dom";


const Home = () => {

    const dispatch    = useDispatch();

    const bearerToken = useSelector(selectBearerToken);

    const user        = useSelector(selectUsers);

    const shops       = useSelector(selectorShops);

    const navigate    = useNavigate();

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
                console.log('error caught in home: ', error);
            }
        })();
    }, [bearerToken, shops])

    return (
        <div className="min-h-screen bg-slate-900 text-white p-6">
            <div className="max-w-5xl mx-auto">
            <div className="flex items-center justify-between mb-8">
                <h1 className="text-xl font-bold">Explore trusted barber and choose the perfect spot for your next fresh cut.</h1>
            </div>

            {shops && shops.length > 0 ? (
                <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                {shops.map((shop) => {
                    const initials = shop.name
                    .split(' ')
                    .map(w => w[0])
                    .join('')
                    .slice(0, 2)
                    .toUpperCase();

                    return (
                    <div
                        key={shop.id}
                        className="relative bg-slate-800 rounded-2xl p-5 border border-slate-700 hover:border-slate-500 active:scale-95 transition-all cursor-pointer overflow-hidden"
                        onClick={() => navigate(`/shops/${shop.id}`)}
                    >
                        {/* top accent bar */}
                        <div className="absolute top-0 left-0 right-0 h-1 bg-blue-500 rounded-t-2xl" />

                        {/* header */}
                        <div className="flex items-center gap-3 mt-1">
                        <div className="w-11 h-11 rounded-full bg-blue-500/20 flex items-center justify-center text-blue-400 font-medium text-sm flex-shrink-0">
                            {initials}
                        </div>
                        <div>
                            <h2 className="text-base font-medium text-white">{shop.name}</h2>
                            <p className="text-sm text-slate-400">{shop.slug}</p>
                        </div>
                        </div>

                        {/* divider */}
                        <div className="border-t border-slate-700 my-4" />

                        {/* contact info */}
                        <div className="flex gap-4 mb-4">
                        <span className="flex items-center gap-1.5 text-sm text-slate-400">
                            {shop.phone}
                        </span>
                        <span className="flex items-center gap-1.5 text-sm text-slate-400">
                            {shop.email}
                        </span>
                        </div>

                        {/* CTA */}
                        <div className="flex items-center justify-between bg-blue-500/10 rounded-xl px-4 py-2.5">
                        <span className="text-sm font-medium text-blue-400">View details &amp; book</span>
                        </div>
                    </div>
                    );
                })}
                </div>
            ) : (
                <p className="text-slate-400 text-center mt-16">No shops available</p>
            )}
            </div>
        </div>
    )
}

export default Home;