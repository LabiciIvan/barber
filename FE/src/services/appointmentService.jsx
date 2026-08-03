const url = "http://localhost:8000/api";

const appointmentService = {
    store: async(shop, barber, service, data, token) => {

        const res = await fetch(`${url}/appointment/shop/${shop}/service/${service}/barber/${barber}`, {
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "Authorization": `Bearer ${token}`,
            },
            method: 'POST',
            body: JSON.stringify(data),
            
        });

        let resResolved = await res.json();

        console.log('----res appointment', res);
        console.log('----resResolved appointment', resResolved);
    }
}

export default appointmentService;