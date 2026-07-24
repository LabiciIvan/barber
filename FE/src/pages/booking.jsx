import { useEffect, useState } from "react";
import { useParams } from "react-router-dom";
import shopService from "../services/shopService";

const Booking = () => {

    const {shopId, serviceId } = useParams();

    const [barbers, setBarbers] = useState([]);

    const [selectedBarber, setSelectedBarber] = useState({});

    useEffect(() => {
        (async () => {
            try {

                const barbers = await shopService.showShopBarbers(shopId);

                setBarbers((prev) => barbers.data);

            } catch (error) {
                console.log('Api call - booking page error: ', error);
            }
        })();
    }, [shopId])

    console.log({shopId});
    console.log({serviceId});

    return (
        <div className="min-h-screen bg-slate-900 text-white p-6">
            <div className="max-w-5xl mx-auto">

                <h2 className="text-base font-semibold text-slate-100 mb-4 tracking-tight">
                    Select a barber
                </h2>

                <div className="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    {barbers.length > 0 && barbers.map((barber) => {
                        const isSelected = selectedBarber?.id === barber.id;

                        return (
                            <div
                                key={barber.id}
                                onClick={() => setSelectedBarber(barber)}
                                className={`
                                    relative cursor-pointer rounded-xl border p-4 transition-colors duration-150
                                    ${isSelected
                                        ? 'border-amber-400 bg-slate-800'
                                        : 'border-slate-700 bg-slate-800/60 hover:border-slate-600 hover:bg-slate-800'}
                                `}
                            >
                                {isSelected && (
                                    <span className="absolute top-3 right-3 flex h-2.5 w-2.5">
                                        <span className="absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75 animate-ping" />
                                        <span className="relative inline-flex h-2.5 w-2.5 rounded-full bg-amber-400" />
                                    </span>
                                )}

                                <div className="flex items-center gap-3">
                                    <div className={`
                                        flex h-10 w-10 shrink-0 items-center justify-center rounded-full text-sm font-semibold
                                        ${isSelected ? 'bg-amber-400 text-slate-900' : 'bg-slate-700 text-slate-300'}
                                    `}>
                                        {barber.name?.charAt(0).toUpperCase()}
                                    </div>

                                    <div className="min-w-0">
                                        <h3 className={`truncate text-sm font-medium ${isSelected ? 'text-white' : 'text-slate-200'}`}>
                                            {barber.name}
                                        </h3>
                                        <p className="truncate text-xs text-slate-400">
                                            {barber.phone}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        );
                    })}
                </div>

            </div>
        </div>
    )

}

export default Booking;
