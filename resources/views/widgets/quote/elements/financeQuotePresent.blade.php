<div :class="['row back', isPresent ? 'd-flex' : 'd-none']">
    <div class="col-12 col-md-6">
        <img class="card-img-top" :src="image" alt="Card image cap">
    </div>
    <div class="col-12 col-md-6">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center  mb-3">
                <h4 class="card-title">Model</h4>
                <h5 class='text-right' v-text="model + ' (' + year + ')'"></h5>
            </div>
            <div class="d-flex justify-content-between align-items-center  mb-3">
                <h4 class="card-title">MSRP</h4>
                <h5 class='text-right' v-text="'$' + msrp"></h5>
            </div>
            <div class="d-flex justify-content-between align-items-center  mb-3">
                <h4 class="card-title">Term</h4>
                <h5 class='text-right' v-text="term"></h5>
            </div>
            <div class="d-flex justify-content-between align-items-center  mb-3">
                <h4 class="card-title">Miles</h4>
                <h5 class='text-right' v-text="milesArray[miles]"></h5>
            </div>
            <div class="d-flex justify-content-between align-items-center  mb-3">
                <h4 class="card-title">Total Monthly Payment</h4>
                <h5 class='text-right' v-text="totalMonthlyPayment"></h5>
            </div>
            <div class="d-flex justify-content-between align-items-center  mb-3">
                <h4 class="card-title card-tmp">Due At Signing</h4>
                <h5 class='text-right' v-text="'$' + dueAtSigning"></h5>
            </div>
        </div>
    </div>
</div>
