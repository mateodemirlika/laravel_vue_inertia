import { computed, isRef } from "vue";

export const useMonthlyPayment = (total, interestRate, duration) => {
    const monthlyPayment = computed(() => {
        const principle = isRef(total) ? total.value : total;
        const monthlyInterest = isRef(interestRate)
            ? interestRate.value / 100 / 12
            : interestRate / 100 / 12;
        const numberOfPaymentMonths = isRef(duration.value)
            ? duration.value * 12
            : duration.value * 12;
        return (
            principle *
            monthlyInterest *
            Math.pow(1 + monthlyInterest, numberOfPaymentMonths)
        );
    });

    const totalPaid = computed(() => {
        return isRef(duration)
            ? duration.value * 12 * monthlyPayment.value
            : duration * 12 * monthlyPayment.value;
    });
    const totalInterest = computed(() => {
        return totalPaid.value - (isRef(total) ? total.value : total);
    });
    return { monthlyPayment, totalPaid, totalInterest };
};
