import { useEffect, useState } from "react";
import { useParams } from "react-router-dom";
import shopService from "../services/shopService";
import LoadingSpinner from "../components/LoadingSpinner";

const Shop = () => {

    const { id } = useParams();

    const [shopLoading, setShopLoading]         = useState(true);
    const [servicesLoading, setServicesLoading] = useState(true);

    const [shop, setShop]                       = useState([]);

    const [services, setServices]               = useState([]);

    const [barbers, setBarbers]                 = useState([]);

    const [shopError, setShopError]             = useState(null);

    useEffect(() => {
        (async () => {
            try {
                const shopDetails = await shopService.show(id);
                setShop(shopDetails.data);
            } catch (error) {
                setShopError(error.message);
            } finally {
                setShopLoading(false);
            }
        })();
    }, [id]);

    useEffect(() => {
        (async () => {
            try {
                const shopServices = await shopService.showShopServices(id);
                setServices(shopServices.data);
            } catch (error) {
                setShopError(error.message);
            } finally {
                setServicesLoading(false);
            }
        })();
    }, [id]);

    if (shopError) return (
        <div className="min-h-screen bg-slate-900 text-white p-6">
            <p className="text-red-400">{shopError}</p>
        </div>
    );

const serviceIcon = (name) => {
  if (name.toLowerCase().includes('beard')) return '✂️';
  if (name.toLowerCase().includes('shave')) return '🪒';
  return '💈';
};

return (
  <div className="min-h-screen bg-slate-900 text-white pb-8">

    {/* Shop hero */}
    {shopLoading ? (
      <div className="flex justify-center pt-16">
        <LoadingSpinner />
      </div>
    ) : shop && (
      <div className="bg-slate-800 border-b border-slate-700 px-4 pt-6 pb-5">
        <div className="flex items-center gap-3">
          <div className="w-13 h-13 rounded-full bg-blue-500/20 flex items-center justify-center text-blue-400 font-medium text-lg">
            {shop.name.slice(0, 2).toUpperCase()}
          </div>
          <div>
            <h1 className="text-xl font-medium text-slate-100">{shop.name}</h1>
            <p className="text-sm text-slate-400">📍 {shop.city}</p>
          </div>
        </div>
        <a
          href={`https://${shop.subdomain}.yourdomain.com`}
          target="_blank"
          rel="noreferrer"
          className="inline-flex items-center gap-1.5 mt-3 text-xs text-blue-400 bg-blue-500/10 border border-blue-500/30 rounded-full px-3 py-1"
        >
          ↗ {shop.subdomain}.yourdomain.com
        </a>
      </div>
    )}

    {/* Services */}
    {!shopLoading && (
      <>
        <p className="text-xs font-medium text-slate-500 uppercase tracking-widest px-4 pt-5 pb-2">
          Services
        </p>

        {servicesLoading ? (
          <div className="flex justify-center pt-8">
            <LoadingSpinner />
          </div>
        ) : services.length > 0 ? (
          services.map((service) => (
            <div
              key={service.id}
              className="mx-4 mb-2.5 bg-slate-800 rounded-2xl border border-slate-700 p-4 flex items-center gap-3 active:scale-95 transition-transform"
            >
              <div className="w-10 h-10 rounded-xl bg-blue-500/10 flex items-center justify-center text-lg flex-shrink-0">
                {serviceIcon(service.name)}
              </div>
              <div className="flex-1 min-w-0">
                <p className="text-sm font-medium text-slate-100 truncate">{service.name}</p>
                <p className="text-xs text-slate-500">⏱ {service.duration_minutes} min</p>
              </div>
              <div className="flex flex-col items-end gap-1.5 flex-shrink-0">
                <span className="text-base font-medium text-slate-100">
                  ${service.price.toFixed(2)}
                </span>
                <button
                  onClick={() => console.log('Book service', service.id)}
                  className="text-xs font-medium text-blue-400 bg-blue-500/10 rounded-lg px-2.5 py-1"
                >
                  Book now
                </button>
              </div>
            </div>
          ))
        ) : (
          <p className="text-slate-500 text-center mt-12">No services available</p>
        )}
      </>
    )}

  </div>
);
};

export default Shop;