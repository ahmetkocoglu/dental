import {useDispatch, useSelector} from "react-redux";
import {AppDispatch, RootState} from "../store";
import {useEffect, useState} from "react";
import {fetchAppointmentData, setAppointment, deleteAppointment, updateAppointment} from "../store/apps/appointment";
import {fetchClinicData} from "../store/apps/clinic";
import {fetchDoctorData} from "../store/apps/doctor";
import {fetchTreatmentData} from "../store/apps/treatment";

function Appointment() {
    // ** Redux
    const dispatch = useDispatch<AppDispatch>()

    // ** Selector
    const isLoading: string = useSelector((state: RootState) => state.appointment.isLoading)
    const isSave: string = useSelector((state: RootState) => state.appointment.isSave)
    const data: never[] = useSelector((state: RootState) => state.appointment.data)
    const clinics: never[] = useSelector((state: RootState) => state.clinic.data)
    const doctors: never[] = useSelector((state: RootState) => state.doctor.data)
    const treatments: never[] = useSelector((state: RootState) => state.treatment.data)

    // ** State
    const [clinic, setClinic] = useState('');
    const [doctor, setDoctor] = useState('');
    const [date, setDate] = useState(null);
    const [isAddTreatment, setIsAddTreatment] = useState(0);
    const [appointmentTreatments, setAppointmentTreatments] = useState<number[]>([]);

    useEffect(() => {
        dispatch(fetchClinicData())
        dispatch(fetchDoctorData())
        dispatch(fetchTreatmentData())
        dispatch(fetchAppointmentData())
    }, [])

    useEffect(() => {
        if (isSave === "succeeded")
            dispatch(fetchAppointmentData())
    }, [isSave])

    const handleSave = (event: any) => {
        event.preventDefault();

        console.log(clinic, doctor, date)

        dispatch(setAppointment({
            "doctor_id": doctor,
            "clinic_id": clinic,
            "appointment_date": date,
            "treatments": "[0]"
        }))
    }

    const handleDelete = (id: number) => {
        dispatch(deleteAppointment(id))
    }
    const handleAddTreatment = (id: number) => {
        setIsAddTreatment(id)
    }

    const handleAddAppointmentTreatments = (id: number) => {
        appointmentTreatments.push(id);
        setAppointmentTreatments(appointmentTreatments.filter((item, pos, ar) => ar.indexOf(item) === pos));
    }

    const handleAppointmentTreatmentsSave = () => {
        dispatch(updateAppointment({id: isAddTreatment, treatment: JSON.stringify(appointmentTreatments)}))
        setIsAddTreatment(0)
    }

    return (
        <>
            {isLoading === 'pending' &&
                (
                    <div>veriler alınıyor</div>
                )}
            {isAddTreatment === 0 ?
                (
                    <table>
                        <thead>
                        <tr>
                            <th></th>
                            <th>Klinik</th>
                            <th>Doktor</th>
                            <th>Tarih</th>
                            <th>Tedaviler</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td></td>
                            <td>
                                <select name="clinic" onChange={(e: any) => setClinic(e.target.value)}>
                                    <option value={0}>Seçiniz...</option>
                                    {clinics.length > 0 && clinics.map((k: any, i: number) => {
                                        return <option value={k.id} key={i}>{k.name}</option>
                                    })}
                                </select>
                            </td>
                            <td>
                                <select name="doctor" onChange={(e: any) => setDoctor(e.target.value)}>
                                    <option value={0}>Seçiniz...</option>
                                    {doctors.length > 0 && doctors.map((k: any, i: number) => {
                                        return <option value={k.id} key={i}>{k.name}</option>
                                    })}
                                </select>
                            </td>
                            <td>
                                <input name="date" type="datetime-local"
                                       onChange={(e: any) => setDate(e.target.value)}/>
                            </td>
                            <td>
                                <button type="button" onClick={handleSave}>Kaydet</button>
                            </td>
                            <td></td>
                        </tr>
                        {data.length > 0 && data.map((k: any, i: number) => {
                            const clinicRow: any = clinics.find((z: any) => z.id === k.clinic_id)
                            const doctorRow: any = doctors.find((z: any) => z.id === k.doctor_id)

                            return <tr key={i}>
                                <td>{k.id}</td>
                                <td>{clinicRow.name}</td>
                                <td>{doctorRow.name}</td>
                                <td>{k.appointment_date}</td>
                                <td>
                                    <button type="button" onClick={() => handleAddTreatment(k.id)}>tedavi ekle</button>
                                </td>
                                <td>
                                    <button type="button" onClick={() => handleDelete(k.id)}>iptal</button>
                                </td>
                            </tr>
                        })}
                        </tbody>
                    </table>
                ) : (
                    <table>
                        <thead>
                        <tr>
                            <th>Tedavi Adı</th>
                        </tr>
                        </thead>
                        <tbody>
                        {treatments.length > 0 && treatments.map((k: any, i: number) => {
                            return <tr key={i} onClick={() => handleAddAppointmentTreatments(k.id)}>
                                <td>{k.name}</td>
                            </tr>
                        })}
                        </tbody>
                        <tfoot>
                        <tr>
                            <td>
                                <button type="button" onClick={() => {
                                    handleAppointmentTreatmentsSave() }}>Tedavi Ekle</button>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                )}
        </>
    );
}

export default Appointment
