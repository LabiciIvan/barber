const url = "http://localhost:8000/api";

const shopService = {
    index: async(data) => {
        const res = await fetch(`${url}/shops/`, {
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
            },
            method: 'GET',
        });

        const responseData = await res.json();

        if (!res.ok) {
            const errorMessage = responseData?.errors?.email?.[0] || responseData?.message || "Login failed!";

            throw {
                message: errorMessage,
                fields: responseData?.errors || null
            };
        }

        return responseData;
    },
    show: async(id) => {
        const res = await fetch(`${url}/shops/${id}`, {
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
            },
            method: 'GET',
        });

        const responseData = await res.json();

        if (!res.ok) {
            throw {
                message: res.statusText,
            }
        }

        return responseData;
    },
    showShopBarbers: async(id) => {
        const res = await fetch(`${url}/shops/${id}/barbers`, {
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
            },
            method: 'GET'
        });

        const responseData = await res.json();

        if (!res.ok) {
            throw {
                message: res.statusText,
            }
        }

        return responseData;
    },
    showShopServices: async(id) => {
        const res = await fetch(`${url}/shops/${id}/services`, {
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
            },
            method: 'GET'
        });

        const responseData = await res.json();

        if (!res.ok) {
            throw {
                message: res.statusText,
            }
        }

        return responseData;
    },
}

export default shopService;