<div :class="['quote-wrapper container p-4 mt-2 mb-2', isPresent ? 'rotate-card' : '']" v-if="page == 'requestResult' && isLease()">
    @include('widgets.quote.elements.leaseQuoteSettings')
    @include('widgets.quote.elements.leaseQuotePresent')
</div>
