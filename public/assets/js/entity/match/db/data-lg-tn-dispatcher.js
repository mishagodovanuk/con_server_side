export const data4 = [
    {
        id: "1",
        number: "236000131",
        suplier:
            '{"company": "Fabric", "location": "133, Zelena St., Rivne"}',
        buyer: '{"company": "LLC “Goldi“", "location": "12, Symonenka St., Zhytomyr"}',
        sending: '{"date": "07.11.2023", "time": "13:00-14:00"}',
        sendingRange: '{"date": "08.11.2023", "time": "13:00-14:00"}',
        delivery: '{"date": "07.11.2023", "time": "16:00-17:00"}',
        deliveryRange: '{"date": "08.11.2023", "time": "16:00-17:00"}',
        pallets: "4",
        uploading: "133, Zelena St., Rivne",
        offloading: "12, Symonenka St., Zhytomyr",
        created: "04.11.2023",
        status: "Signed by all",
        contract: "2342341",
        document: "5423111",
        price: "7500",
        comment: "-",
        type: "Household chemicals",
        weight: "4000",
        customer: "Berta Service",
        route: [
            {
                id: "1",
                terminal: "Loading",
                timeLoading: { start: "13:00", end: "14:00" },
                city: "Rivne",
                address: "133, Zelena St.,",
                time: { date: "07.11.2023 ", period: "13:00-14:00" },
            },
            {
                id: "2",
                terminal: "Unloading",
                timeLoading: { start: "16:00", end: "17:00" },
                city: "Zhytomyr",
                address: "12, Symonenka St., Zhytomyr",
                time: { date: "07.11.2023", period: "16:00-17:00" },
            },
        ],
    },
    // {
    //     id: "2",
    //     number: "12312355",
    //     suplier:
    //         '{"company": "LLC “ATB”", "location": "1, Shyroka St., Zhytomyr"}',
    //     buyer: '{"company": "LLC “Yarych", "location": "3, Hrushevskoho St., Kyiv"}',
    //     sending: '{"date": "12.04.2023", "time": "10:00-12:00"}',
    //     sendingRange: '{"date": "13.04.2023", "time": "10:00-12:00"}',
    //     delivery: '{"date": "15.04.2023", "time": "9:00-12:00"}',
    //     deliveryRange: '{"date": "16.04.2023", "time": "9:00-12:00"}',
    //     pallets: "5",
    //     uploading: "10, Nalyvaika St., Uzhgorod",
    //     offloading: "4а, Okruzhna St., Vinnytsya",
    //     created: "05.05.2023",
    //     status: "Signed by all",
    //     contract: "23423400",
    //     document: "5423199",
    //     price: "17500",
    //     comment: "-",
    //     type: "Food products",
    //     weight: "5000",
    //     customer: "Berta Service",
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
