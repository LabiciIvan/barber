const userService = {
    show: async(data) => {
        const res = await fetch('http://localhost:8000/api/users/show', {
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "Authorization": `Bearer ${data}`,
            },
            method: 'GET'
        });

        const responseData = await res.json();

        console.log('--responseData--', responseData)

        if (!res.ok) {
            const errorMessage = responseData?.errors?.email?.[0] || responseData?.message || "Error getting user data";

            throw {
                message: errorMessage,
                fields: responseData?.errors || null
            };
        }

        return responseData;
    }
};

export default userService;
