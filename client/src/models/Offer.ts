export type Offer = {
    doc_id: string,
    id: string,
    property_name: string,
    property_total_price: number,
    client_id?: string,
    rooms?: number
};
// list all keys in Offer type and assign them as required by setting : true
type KeysEnum<T> = { [P in keyof Required<T>]: true };

export const OfferAttributeKeys: KeysEnum<Offer> = {
    doc_id: true,
    id: true,
    property_name: true,
    property_total_price: true,
    client_id: true,
    rooms: true
}

export type OfferRequestData = {
    doc_id: string,
}

export type OfferListData = {
    doc_id: string,
    property_name: string,
    property_totalPrice: number
}

