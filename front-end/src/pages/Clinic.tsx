import {useDispatch, useSelector} from "react-redux";
import {AppDispatch, RootState} from "../store";
import {useEffect} from "react";
import {fetchClinicData} from "../store/apps/clinic";

function Clinic() {
    // ** Redux
    const dispatch = useDispatch<AppDispatch>()

    // ** Selector
    const isLoading: string = useSelector((state: RootState) => state.clinic.isLoading)
    const data: never[] = useSelector((state: RootState) => state.clinic.data)

    useEffect(() => {
        dispatch(fetchClinicData())
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
                                <th>Klinik Adı</th>
                            </tr>
                            </thead>
                            <tbody>
                            {data.map((k: any, i: number) => {
                                return <tr key={i}>
                                    <td>{k.name}</td>
                                </tr>
                            })}
                            </tbody>
                        </table>
                    </>
                )}
        </>
    );
}

export default Clinic
