export interface FakeOffer {
    doc_id: string,
    property_name: string,
    total_price: number,
    client: string,
    type: string,
    rooms: number  
}

export const fakeOffers: FakeOffer[] = [
    {
        doc_id: '3vN8JnQBUtAUXlXmZziP',
        property_name: 'ul. Jana z Kolna 99',
        total_price: 1300000.5,
        client: 'Bartosz Bazylewicz',
        type: 'apartment',
        rooms: 3 
    },
    {
        doc_id: '1ybzJnQBx2hIb8UKdpCQ',
        property_name: 'ul. Orzeszkowej 37',
        total_price: 5501112,
        client: 'Mateusz Kowalewski',
        type: 'house',
        rooms: 4
    },
    {
        doc_id: '2CYdJ3QBx2hIb8UKsZB2',
        property_name: 'Orzeszkowej Estates',
        total_price: 5501112,
        client: 'Bartosz Bazylewicz',
        type: 'apartment',
        rooms: 5
    }
]