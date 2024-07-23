
  export async function optimizeAndFindOptimalWay(dataAddresses) {
      const geocodingUrl = "https://maps.googleapis.com/maps/api/geocode/json";
      // замінити ключ на sk пошту
    const apiKey = "AIzaSyAMVD23D0c1TMSMX7m66SjY365nXzTb3lU";
    const R = 6371;

    const deg2rad = (deg) => deg * (Math.PI / 180);

    const calculateDistance = (coord1, coord2) => {
        const dLat = deg2rad(coord2.lat - coord1.lat);
        const dLng = deg2rad(coord2.lng - coord1.lng);

        const a =
            Math.sin(dLat / 2) * Math.sin(dLat / 2) +
            Math.cos(deg2rad(coord1.lat)) * Math.cos(deg2rad(coord2.lat)) * Math.sin(dLng / 2) * Math.sin(dLng / 2);

        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

        return R * c;
    };

    const getCoordinates = async (address) => {
        const requestUrl = `${geocodingUrl}?address=${encodeURIComponent(address)}&key=${apiKey}`;

        try {
            const response = await fetch(requestUrl);
            const data = await response.json();

            if (data.status === "OK") {
                const location = data.results[0].geometry.location;
                return { lat: location.lat, lng: location.lng };
            } else {
                throw new Error(`Error: ${data.status}`);
            }
        } catch (error) {
            throw new Error(`Request error: ${error}`);
        }
    };

    const getCoordinatesForCustomData = async (dataAddresses) => {
        try {
            const coordinatesArray = await Promise.all(dataAddresses.map(obj => getCoordinates(obj.warehouse_address)));

            return dataAddresses.map((obj, index) => ({ ...obj, coordinates: coordinatesArray[index] }));
        } catch (error) {
            throw new Error(`Error getting coordinates: ${error.message}`);
        }
    };

    const permute = (arr) => {
        if (arr.length === 1) {
            return [arr];
        }

        const result = [];

        for (let i = 0; i < arr.length; i++) {
            const rest = [...arr.slice(0, i), ...arr.slice(i + 1)];
            const permutations = permute(rest);

            for (const perm of permutations) {
                result.push([arr[i], ...perm]);
            }
        }

        return result;
    };

    const findOptimalOrder = (cities) => {
        const permutations = permute(cities);

        let minDistance = Number.MAX_VALUE;
        let optimalOrder;

        for (const permutation of permutations) {
            let totalDistance = 0;

            for (let i = 0; i < permutation.length - 1; i++) {
                const distance = calculateDistance(permutation[i].coordinates, permutation[i + 1].coordinates);
                totalDistance += distance;
            }

            if (totalDistance < minDistance) {
                minDistance = totalDistance;
                optimalOrder = permutation;
            }
        }

        return optimalOrder;
    };

    try {
        const dataWithCoordinates = await getCoordinatesForCustomData(dataAddresses);
        const optimalOrder = findOptimalOrder(dataWithCoordinates);
        console.log(optimalOrder);
        return optimalOrder;
    } catch (error) {
        throw new Error(`Optimization error: ${error.message}`);
    }
}


// var dataAdress = [
    //     {
    //         id: "6",
    //         warehouse_address: "Київська область, Бориспільський район, Вишеньківська сільська рада",
    //     },
        
    // ];
    
    

// Usage

// await optimizeAndFindOptimalWay(dataAdress);
