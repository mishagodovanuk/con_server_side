// groupByCompany
export function groupByCompany(data) {
    let count = 0;
    return data.reduce(function (acc, item) {
        var existingCompany = acc.find(function (group) {
            return group.name === item.company;
        });
        if (existingCompany) {
            existingCompany.arr.push(item);
        } else {
            count++;
            acc.push({
                idCompany: count,
                name: item.company,
                arr: [item],
            });
        }

        return acc;
    }, []);
}