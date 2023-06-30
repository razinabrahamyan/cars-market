<div :class="['row front', isPresent ? 'd-none' : 'd-flex']">
    <div class="col-12 col-md-4 mb-5">
        <img class="card-img border shadow-sm" :src="image" alt="Card image cap">
    </div>
    <div class="col-12 col-md-8">
        <div class="d-flex justify-content-between align-items-center  mb-3">
            <h4 class="card-title">Model</h4>
            <h5 class='text-right' v-text="model + ' (' + year + ')'"></h5>
        </div>
        <div class="d-flex justify-content-between align-items-center  mb-3">
            <h4 class="card-title">MSRP</h4>
            <h5 class='text-right' v-text="'$' + msrp"></h5>
        </div>
        <div class="d-flex justify-content-between align-items-center  mb-3">
            <h4 class="card-title">Residual Value</h4>
            <h5 class='text-right' v-text="residualValuePercent + '%'"></h5>
        </div>
        <div class="d-flex justify-content-between align-items-center  mb-3">
            <h4 class="card-title">Selling Price</h4>
            <h5 class='text-right' v-text="'$' + sellingPrice"></h5>
        </div>
        <div class="d-flex justify-content-between align-items-center  mb-3">
            <h4 class="card-title card-tmp">Total Monthly Payment</h4>
            <h5 class='text-right' v-text="'$' + totalMonthlyPayment"></h5>
        </div>
        <div class="d-flex justify-content-between align-items-center  mb-3">
            <h4 class="card-title card-tmp">Due At Signing</h4>
            <h5 class='text-right' v-text="'$' + dueAtSigning"></h5>
        </div>
        <div class="d-flex justify-content-between align-items-center  mb-3">
            <h4 class="card-title">Money Factor</h4>
            <h5 class='text-right' v-text="moneyFactor"></h5>
        </div>
        <div class="d-flex justify-content-between align-items-center  mb-3">
            <h4 class="card-title">Invoice</h4>
            <input class="form-control percent value rv-input" type="text"
                   v-model.number="invoicePercent" inputmode="numeric"
                   maxlength="6">
        </div>
        <div class="d-flex justify-content-between align-items-center  mb-3">
            <h4 class="card-title">Roll Taxes Into<br>The Monthly Payment</h4>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="form-control custom-control-input" id="rollTaxesIntoTheMonthlyPayment"
                       v-model.bool="rollTaxesIntoTheMonthlyPayment">
                <label class="custom-control-label" for="rollTaxesIntoTheMonthlyPayment" v-text=""></label>
            </div>
        </div>
        <div id="rebates-block" class="row mb-2"
             v-if="rebatesList.incentiveBonus && rebatesList.leaseBonusCash && rebatesList.fleetIncentive">
            <h4 class="m-0 mt-1 mb-2 text-center">Rebates</h4>
            <div id="lease-incentiveBonus-block" class="col-6 text-center"
                 v-if="rebatesList.incentiveBonus">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="incentiveBonus"
                           :value="rebatesList.incentiveBonus" v-model="checkedRebates"
                           @change="rebatesSum">
                    <label class="custom-control-label" for="incentiveBonus"
                           v-text="'Incentive Bonus ( $' + rebatesList.incentiveBonus + ' )'">
                    </label>
                </div>
            </div>
            <div id="lease-leaseBonusCash-block" class="col-6 text-center"
                 v-if="rebatesList.leaseBonusCash">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="leaseBonusCash"
                           :value="rebatesList.leaseBonusCash" v-model="checkedRebates"
                           @change="rebatesSum">
                    <label class="custom-control-label" for="leaseBonusCash"
                           v-text="'Lease Bonus Cash ( $' + rebatesList.leaseBonusCash + ' )'">
                    </label>
                </div>
            </div>
            <div id="lease-fleetIncentive-block" class="col-6 text-center"
                 v-if="rebatesList.fleetIncentive">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="fleetIncentive"
                           :value="rebatesList.fleetIncentive" v-model="checkedRebates"
                           @change="rebatesSum">
                    <label class="custom-control-label" for="fleetIncentive"
                           v-text="'Incentive Bonus ( $' + rebatesList.fleetIncentive + ' )'">
                    </label>
                </div>
            </div>
        </div>
        <div class="d-flex mb-3">
            <div class="row m-auto text-center">
                <div class="col-12">
                    <h5 class="m-0 mt-1 mb-2">Lease Term</h5>
                </div>
                <div class="d-flex flex-wrap col-12 justify-content-center p-0">
                    <div class="d-flex m-1"
                         v-for="(termItem, index) in termArray" :key="index">
                        <input type="radio" class="btn-check" v-model="term"
                               name="termRadio" :id="'termRadio' + index"
                               :value="termItem" autocomplete="off">
                        <label class="btn btn-outline-success"
                               :for="'termRadio' + index"
                               v-html="termItem  + '<br>Months<br>$'+ totalMonthlyPaymentByTermAndMile(termItem,false)">
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex mb-3">
            <div class="row m-auto text-center">
                <div class="col-12">
                    <h5 class="m-0 mt-1 mb-3">How Much Do You Drive?</h5>
                </div>
                <div class="d-flex flex-wrap col-12 justify-content-center p-0">
                    <div class="d-flex m-1"
                         v-for="(mileItem, index) in milesArray" :key="index">
                        <input type="radio" class="btn-check" v-model="miles"
                               name="milesRadio" :id="'milesRadio' + index"
                               :value="index" autocomplete="off" checked>
                        <label class="btn btn-outline-success"
                               :for="'milesRadio' + index"
                               v-html="mileItem + '<br> Miles <br> per year <br>'">
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="title">
                <h5 class="m-0 mt-1">Down Payment</h5>
                <input class="form-control value rv-input" v-model.number="downPayment"
                       type="number"
                       inputmode="numeric" min="0" :max="msrp">
            </div>
            <div class="range-slider-holder">
                <input type="range" min="0" :max="msrp" id="distance"
                       class="range-slider" v-model.number="downPayment">
            </div>
        </div>
        <div>
            <div class="title">
                <h5 class="m-0 mt-1">Profit</h5>
                <input class="form-control value rv-input" v-model.number="profit"
                       type="number"
                       inputmode="numeric" min="0" :max="msrp">
            </div>
            <div class="range-slider-holder">
                <input type="range" min="0" :max="msrp" id="distance"
                       class="range-slider" v-model.number="profit">
            </div>
        </div>
        <div class="d-flex m-auto text-center p-3">
            <button type="button" class="btn btn-outline-success m-auto p-3" @click="sendPage">Submit Quote
            </button>
        </div>
    </div>
</div>
