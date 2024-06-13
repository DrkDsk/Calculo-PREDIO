import axios from "axios";
import * as XLSX from "xlsx";

const roundNumber = (value) => {
    if (typeof value === 'number') {
        return parseFloat(value.toFixed(3)); // Adjust the number of decimals as needed
    }
    return value;
};

const fetchExcel = async (sheetIndex,excelUrl) => {

    try {
        const response = await axios.get(excelUrl, {
            responseType: 'arraybuffer'
        })

        const data = new Uint8Array(response.data);
        const workbook = XLSX.read(data, {type: 'array'})
        const sheetName = workbook.SheetNames[sheetIndex]
        const workSheet = workbook.Sheets[sheetName]
        let jsonSheet = XLSX.utils.sheet_to_json(workSheet, { header: 1 });
        return jsonSheet.map(row => row.map(cell => roundNumber(cell)))
    } catch (error) {

    }
}

export {
    roundNumber,
    fetchExcel
}
