import {useDispatch, useSelector} from "react-redux";
import {AppDispatch, RootState} from "../store";
import {useEffect} from "react";
import {fetchDoctorData} from "../store/apps/doctor";

function Doctor() {
    // ** Redux
    const dispatch = useDispatch<AppDispatch>()

    // ** Selector
    const isLoading: string = useSelector((state: RootState) => state.doctor.isLoading)
    const data: never[] = useSelector((state: RootState) => state.doctor.data)

    useEffect(() => {
        dispatch(fetchDoctorData())
    }, [])

    return (
        <>
            {isLoading === 'pending' &&
                (
                    <div>veriler alınıyor</div>
                )}
            {isLoading === 'succeeded' &&
                (
                    <>
                        <table>
                            <thead>
                            <tr>
                                <th>Doktor Adı</th>
                                <th>Telefon</th>
                            </tr>
                            </thead>
                            <tbody>
                            {data.map((k: any, i: number) => {
                                return <tr key={i}>
                                    <td>{k.name}</td>
                                    <td>{k.phone}</td>
                                </tr>
                            })}
                            </tbody>
                        </table>
                    </>
                )}
        </>
    );
}

export default Doctor
