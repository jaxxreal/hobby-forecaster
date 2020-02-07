const COST_1GB_RAM_PER_HOUR = 0.00553; // The cost of 1GB of RAM per hour is 0.00553 USD
const RAM_PER_STUDY_MB = 0.5;
const STORAGE_PER_STUDY_MB = 10;

const STORAGE_VALUE = 1000;
const COST_1GB_STORAGE_PER_MONTH = 0.1;
const STUDY_SIZE = 10;

function calcSum(firstNumber, commonRatio, numberToObtain) {
    const summ = [];

    for (let i = 0; i < numberToObtain; i++) {
        const prevMonthStudiesNumber = summ[i - 1] ? summ[i - 1].numberOfStudiesPerDay : firstNumber;
        const prevVolumeOfStudiesPerMonthMb = summ[i - 1] ? summ[i - 1].volumeOfStudiesPerMonthMb : 0;

        const numberOfStudiesPerDay = prevMonthStudiesNumber + prevMonthStudiesNumber * commonRatio;
        console.log(numberOfStudiesPerDay);
        
        // We only need to have enough RAM for one day of study.
        const ramPerDayMb = numberOfStudiesPerDay * RAM_PER_STUDY_MB;
        const ramPerDayCost = (ramPerDayMb / 1000) * COST_1GB_RAM_PER_HOUR;

        // Studies are kept indefinitely. 1 study use 10 MB of storage. 1 GB of storage cost 0.10 USD per month.
        const numberOfStudiesPerMonth = numberOfStudiesPerDay * 30;
        const volumeOfStudiesPerMonthMb = numberOfStudiesPerMonth * STORAGE_PER_STUDY_MB;

        const storagePerMonthCost = (volumeOfStudiesPerMonthMb / 1000 + prevVolumeOfStudiesPerMonthMb / 1000) * COST_1GB_STORAGE_PER_MONTH;
        console.log(storagePerMonthCost);

        summ[i] = {
            numberOfStudiesPerDay,
            volumeOfStudiesPerMonthMb,
            numberOfStudiesPerMonth,
            costPerMonth: ramPerDayCost + storagePerMonthCost,
        };
    }

    return summ;
}

const res = calcSum(1, 0.3, 2);

console.log(res);