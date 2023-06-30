let VinVue = new Vue({
    el: '#calc_widget',
    data: function () {
        return this.initialState();
    },
    watch: {
        //For Quick Quote ----------
        msrp: function () {
            console.log('msrp')

        },
        residualValuePercent: function () {
            console.log('residualValuePercent')
            this.vin.fees = this.quickQuoteFees
            console.log(this.vin)
            // this.totalMonthlyPaymentByTermAndMile(this.term)

        },
        sellingPrice: function () {
            console.log('sellingPrice')

        },
        //------------------------------
        miles: function () {
            this.residualValueByTermAndMile();
            this.calculate();
        },
        term: function () {
            this.residualValueByTermAndMile();
            this.calculate();
            this.financeCalculation();
        },
        profit: function () {
            this.calculate();
        },
        downPayment: function () {
            this.calculate();
        },
        invoicePercent: function () {
            this.calculate();
        },
        rollTaxesIntoTheMonthlyPayment: function () {
            this.calculate();
        },
        APR: function () {
            this.financeCalculation();
        },
    },
    mounted() {
        /*For VIN validation*/
        $('#vin').keypress(function (e) {
            let txt = String.fromCharCode(e.which);
            if (!txt.match(/[A-Za-z0-9&. ]/)) {
                return false;
            }
        });
        /*For VIN validation*/
    },
    methods: {
        initialState() {
            return {
                calculationType: 'Finance',
                image: '',
                page: 'vincode',
                vin: null,
                model: '',
                year: '',
                msrp: 0,
                discount: 0,
                defaultResidualValues: {},
                residualValuePercent: 0,
                residualValuePercentNew: 0,
                sellingPrice: 0,
                residualValueRange: Array.from(Array(100).keys()),
                moneyFactor: 0.00084,
                term: 36,
                termArray: [24, 30, 36, 42, 48, 54, 60], //TODO: Get From DB
                miles: 0,
                milesArray: [7500, 10000, 12000, 15000, 20000], //TODO: Get From DB
                monthlyPayment: 0,
                totalMonthlyPayment: 0,
                isPresent: false,
                profit: 2000,
                invoicePercent: 0,
                downPayment: 0,
                taxRates: 8.875,
                dueAtSigning: 0,
                fees: {
                    DMVFee: 0,
                    BankFee: 0,
                    DocFee: 0,
                    Inspection: 0,
                    TierTax: 0,
                    GasCharge: 0,
                    FreightFee: 0,
                    FreightFeeExtra: 0,
                },
                invoice: 0,
                mails: '',
                checkedRebates: [],
                rebatesList: {
                    incentiveBonus: "",
                    leaseBonusCash: "",
                    fleetIncentive: "",
                },
                rollTaxesIntoTheMonthlyPayment: false,

                quickQuoteFees: {
                    basicFees: {
                        BankFee: 1095,
                        DMVFee: 275,
                        DocFee: 175,
                        GasCharge: 45,
                        Inspection: 10,
                        TierTax: 12.5,
                    },
                    invoiceFees: {
                        FreightFee: 1050,
                        FreightFeeExtra: 40,
                    }
                },
                PMT: 0,
                APR: 5,
            }
        },
        isLease: function () {
            return this.calculationType === 'Lease';
        },
        isFinance: function () {
            return this.calculationType === 'Finance';
        },
        newVin() {
            this.page = 'vincode';
            this.vin = null;
        },
        quotePage() {
            this.page = 'requestResult';
        },
        sendPage() {
            this.page = 'send';
        },
        calculate() {
            let invoice, residualValue, rebatesSum, sellingPrice, totalPayment, monthlyPayment, tax = 0, feesSum = 0,
                monthlyMoneyFactor, totalMonthlyPayment, otherTax, dueAtSigning, fees_and_downPayment;

            if (this.invoicePercent > 0) {
                //new invoice formula
                invoice = (this.msrp - this.fees.invoiceFees.FreightFee) * this.invoicePercent / 100 + (this.fees.invoiceFees.FreightFee + this.fees.invoiceFees.FreightFeeExtra)
                //old invoice formula
                // invoice = this.msrp - (this.msrp * this.invoicePercent / 100) - this.discount;
            } else {
                invoice = this.msrp - this.discount;
            }

            if (Object.keys(this.fees).length > 0 && Object.keys(this.fees.basicFees).length > 0) {
                otherTax = (this.fees.basicFees.BankFee + this.fees.basicFees.DocFee + this.fees.basicFees.GasCharge) * (this.taxRates / 100)
                feesSum = (Object.values(this.fees.basicFees).reduce((a, b) => a * 1 + b * 1) + otherTax)
            }

            residualValue = (this.msrp * this.residualValuePercent) / 100;
            rebatesSum = (this.checkedRebates.length > 0) ? this.checkedRebates.reduce((a, b) => a * 1 + b * 1) * 1 : 0;
            sellingPrice = (invoice - rebatesSum + this.profit)
            totalPayment = sellingPrice - residualValue - this.downPayment;
            monthlyPayment = totalPayment / this.term;
            monthlyMoneyFactor = (sellingPrice + residualValue - this.downPayment) * this.moneyFactor;
            totalMonthlyPayment = monthlyMoneyFactor + monthlyPayment;
            tax = totalMonthlyPayment * this.term * (this.taxRates / 100);

            //Recalculation with taxes
            if (this.rollTaxesIntoTheMonthlyPayment) {
                totalPayment = sellingPrice - residualValue - this.downPayment + tax;
                monthlyPayment = totalPayment / this.term;
                monthlyMoneyFactor = (sellingPrice + residualValue - this.downPayment + tax) * this.moneyFactor;
                totalMonthlyPayment = monthlyMoneyFactor + monthlyPayment;
            }

            fees_and_downPayment = (this.downPayment > 0) ? (this.downPayment + this.downPayment * this.taxRates / 100) : 0;

            if (this.rollTaxesIntoTheMonthlyPayment) {
                dueAtSigning = totalMonthlyPayment + feesSum + fees_and_downPayment;
            } else {
                dueAtSigning = totalMonthlyPayment + feesSum + tax + fees_and_downPayment;
            }

            this.totalMonthlyPayment = totalMonthlyPayment.toFixed(2) * 1;
            this.dueAtSigning = dueAtSigning.toFixed(2) * 1;
            this.sellingPrice = sellingPrice;
            this.invoice = invoice;
        },
        residualValueByTermAndMile(term = this.term, miles = this.miles, changeData = true) {
            let residualValuePercent;
            switch (this.milesArray[miles]) {
                case 15000:
                    residualValuePercent = this.defaultResidualValues[term];
                    // residualValuePercent = 54; //54 for test
                    break;
                case 7500:
                    residualValuePercent = this.defaultResidualValues[term] + 4;
                    // residualValuePercent = 54; //54 for test
                    break;
                case 10000:
                    residualValuePercent = this.defaultResidualValues[term] + 3;
                    // residualValuePercent = 54; //54 for test
                    break;
                case 12000:
                    residualValuePercent = this.defaultResidualValues[term] + 2;
                    // residualValuePercent = 54; //54 for test
                    break;
                case 20000:
                    residualValuePercent = this.defaultResidualValues[term] - 5;
                    // residualValuePercent = 54; //54 for test
                    break;
            }

            if (changeData) {
                this.residualValuePercent = residualValuePercent;
            }
            return residualValuePercent;
        },
        sendVin() {
            const config = {
                headers: {
                    Accept: 'application/json',
                }
            }

            axios.post('/axios/minimalQuote', {vin: VinVue.vin}, config).then(response => {
                let calculationType = this.calculationType;
                Object.assign(this.$data, this.initialState());

                let data = response.data;
                VinVue.calculationType = calculationType;
                VinVue.page = 'requestResult';
                VinVue.model = data.model;
                VinVue.msrp = data.crawl.msrp;
                // VinVue.msrp = 53670; //for test
                VinVue.moneyFactor = data.moneyFactor;
                // VinVue.moneyFactor = 0.00117; //for test
                VinVue.discount = data.discount;
                // VinVue.discount = 3000; //for test.
                VinVue.rebatesList = data.rebatesList;
                VinVue.defaultResidualValues = data.residualValues;
                VinVue.termArray = data.termArray;
                VinVue.image = data.image;
                VinVue.year = data.crawl.year;
                VinVue.term = data.termArray[2];
                VinVue.residualValueByTermAndMile();
                VinVue.fees = JSON.parse(data.fees);
                VinVue.invoicePercent = data.invoice;
                console.log(JSON.parse(data.fees))
                this.calculate()
                this.financeCalculation();
            }).catch(e => {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: "Couldn't find anything",
                    showConfirmButton: false,
                    timer: 1500
                })
                this.page = 'vincode';
                console.log(e);
            });
        },
        sendEmail(event) {
            event.preventDefault();
            if (this.mails !== undefined && this.mails !== '') {
                axios.post('/axios/sendQuoteToEmail', {
                    email: this.mails,
                    model: this.model,
                    msrp: this.msrp,
                    term: this.term,
                    miles: this.milesArray[this.miles],
                    monthlyPayment: this.monthlyPayment,
                    image: VinVue.image,
                }, {
                    headers: {
                        Accept: 'application/json',
                    }
                }).then(response => {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Email successfully sent',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }).catch(e => {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'OOPS... Something has gone wrong',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    console.log(e);
                });
            }
        },
        vinInput(e) {
            if (e.which === 13) {
                this.submit();
            }
        },
        submit() {
            if (this.vin.length === 17) {
                this.page = 'waiting';
                this.sendVin();
                $('#vin').css('border-color', 'unset');
            } else {
                $('#vin').css('border-color', 'red');
            }
        },
        //For Quick Quote ----------------------------
        goToQuickQuote() {
            Object.assign(this.$data, this.initialState());
            this.page = 'quickQuote'
            VinVue.msrp = 0
        },
        //---------------------------------------------
        rotatePresent() {
            this.isPresent = !this.isPresent;
        },

        financeCalculation(term = this.term, changeData = true) {
            let PMT, PV, tax = 0;

            if (this.rollTaxesIntoTheMonthlyPayment) {
                tax = this.msrp * (this.taxRates / 100);
            }

            PV = this.msrp - this.downPayment + tax;
            PMT = ((this.APR / 100) / 12 * (PV)) / (1 - Math.pow((1 + (this.APR / 100) / 12), term * -1));
            PMT = PMT.toFixed(2);
            if (changeData) {
                this.PMT = PMT;
            }

            return PMT;
        },
        /*CUSTOM FORMULAS*/
        totalMonthlyPaymentByTermAndMile(term) {
            let invoice, residualValue, rebatesSum, sellingPrice, totalPayment, monthlyPayment,
                monthlyMoneyFactor, totalMonthlyPayment, residualValuePercent, tax = 0;

            if (this.invoicePercent > 0) {
                //new invoice formula
                invoice = (this.msrp - this.fees.invoiceFees.FreightFee) * this.invoicePercent / 100 + (this.fees.invoiceFees.FreightFee + this.fees.invoiceFees.FreightFeeExtra)
                //old invoice formula
                // invoice = this.msrp - (this.msrp * this.invoicePercent / 100) - this.discount;
            } else {
                invoice = this.msrp - this.discount;
            }

            //Get RV precent for actual term and mile
            residualValuePercent = this.residualValueByTermAndMile(term, this.miles, false);

            residualValue = (this.msrp * residualValuePercent) / 100;
            rebatesSum = (this.checkedRebates.length > 0) ? this.checkedRebates.reduce((a, b) => a * 1 + b * 1) * 1 : 0;
            sellingPrice = (invoice - rebatesSum + this.profit)
            totalPayment = sellingPrice - residualValue - this.downPayment;
            monthlyPayment = totalPayment / term;
            monthlyMoneyFactor = (sellingPrice + residualValue - this.downPayment) * this.moneyFactor;
            totalMonthlyPayment = monthlyMoneyFactor + monthlyPayment;
            tax = totalMonthlyPayment * term * this.taxRates / 100;

            if (this.rollTaxesIntoTheMonthlyPayment) {
                residualValue = (this.msrp * residualValuePercent) / 100;
                sellingPrice = (invoice - rebatesSum + this.profit);
                totalPayment = sellingPrice - residualValue - this.downPayment + tax;
                monthlyPayment = totalPayment / term;
                monthlyMoneyFactor = (sellingPrice + residualValue - this.downPayment + tax) * this.moneyFactor;
                totalMonthlyPayment = monthlyPayment + monthlyMoneyFactor;
            }

            return totalMonthlyPayment.toFixed(2) * 1;
        }
        /*CUSTOM FORMULAS*/
    },
})

