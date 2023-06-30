<div :class="['quote-wrapper container p-4 mt-2 mb-2', isPresent ? 'rotate-card' : '']" v-if="page == 'requestResult' && isFinance()">
    @include('widgets.quote.elements.financeQuoteSettings')
    @include('widgets.quote.elements.financeQuotePresent')
</div>
