
interface Vehicle {
    id: string;
    name: string;
    category_id: string;
    in_service: boolean;
    agency_id: string;
    brand: string;
    model: string;
    registration_number: string;
    chassis_number: string;
    fuel_id: string;
    doors_number: number;
    fiscal_power: string;
    circulation_start_date: Date;
    last_mileage: number;
    purchase_value: string;
    dealer: string;
    is_rented: boolean;
    image_path: string;
    vehicle_options: [];
    description: string;

    category: {
        id: string;
        label: string;
    };

    agency: {
        id: string;
        label: string;
    };
}

export default Vehicle
