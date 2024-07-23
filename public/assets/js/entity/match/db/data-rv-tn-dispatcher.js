export const data6 = [
    {
        id: "1",
        number: "236000139",
        suplier:
            '{"company": "LLC “Yarych”", "location": "112, Sportyvna St., Odesa"}',
        buyer: '{"company": "LLC “Metro”", "location": "22, Shevchenka St., Vinnytsia"}',
        sending: '{"date": "07.11.2023", "time": "21:00-22:00"}',
        sendingRange: '{"date": "08.11.2023", "time": "21:00-22:00"}',
        delivery: '{"date": "07.11.2023", "time": "23:00-23:30"}',
        deliveryRange: '{"date": "08.11.2023", "time": "23:00-23:30"}',
        pallets: "4",
        uploading: "112, Sportyvna St., Odesa",
        offloading: "22, Shevchenka St., Vinnytsia",
        created: "04.11.2023",
        status: "Sent",
        contract: "2342341",
        document: "5423111",
        price: "3500",
        comment: "-",
        type: "Textile",
        weight: "4000",
        customer: "Berta Service",
        uploadingCity: "Odesa",
        offloadingCity: "Vinnytsia",
        route: [
            {
                id: "1",
                terminal: "Loading",
                timeLoading: { start: "21:00", end: "22:00" },
                city: "Odesa",
                address: "112, Sportyvna St.,",
                time: { date: "07.11.2023 ", period: "21:00-22:00" },
            },
            {
                id: "2",
                terminal: "Unloading",
                timeLoading: { start: "23:00", end: "23:20" },
                city: "Vinnytsia",
                address: "22, Shevchenka St.,",
                time: { date: "07.11.2023", period: "23:00-23:20" },
            },
        ],
    },
    // {
    //     id: "2",
    //     number: "12312355",
    //     suplier:
    //         '{"company": "LLC “ATB”", "location": "1, Shyroka St., Zhytomyr"}',
    //     buyer: '{"company": "LLC “Yarych", "location": "3, Hrushevskogo St., Kyiv"}',
    //     sending: '{"date": "12.04.2023", "time": "10:00-12:00"}',
    //     sendingRange: '{"date": "13.04.2023", "time": "10:00-12:00"}',
    //     delivery: '{"date": "15.04.2023", "time": "9:00-12:00"}',
    //     deliveryRange: '{"date": "16.04.2023", "time": "9:00-12:00"}',
    //     pallets: "5",
    //     uploading: "10, Nalyvaika St., Uzhgorod",
    //     offloading: "4а, Okruzhna St., Vinnytsya",
    //     created: "05.05.2023",
    //     status: "Sent",
    //     contract: "23423400",
    //     document: "5423199",
    //     price: "17500",
    //     comment: "-",
    //     type: "Food products",
    //     weight: "5000",
    //     customer: "Berta Service",
    //     uploadingCity: "Uzhgorod",
    //     offloadingCity: "Vinnytsya",
    //     route: [
    //         {
    //             id: "1",
    //             terminal: "Loading",
    //             timeLoading: { start: "02:23", end: "04:00" },
    //             city: "Uzhgorod",
    //             address: "10, Nalyvaika St.",
    //             time: { date: "07.05.2023 ", period: "08:00-18:00" },
    //         },
    //         {
    //             id: "2",
    //             terminal: "Unloading",
    //             timeLoading: { start: "05:18", end: "06:30" },
    //             city: "Vinnytsya",
    //             address: "4а, Okruzhna St.",
    //             time: { date: "07.05.2023", period: "09:30-19:30" },
    //         },
    //     ],
    // },
];
