<div  :class="['quote-wrapper container p-4 mt-2 mb-2', isPresent ? 'rotate-card' : '']" v-if="page == 'quickQuote'">
    @include('widgets.quote.quick_quote.elements.quickQuoteSettings')
{{--    @include('widgets.quote.elements.quotePresent')--}}
</div>