<div class="certification-card">
    <div class="certification-header">
        <h4>{{ $title }}</h4>
        <p class="price">{{ $price }}</p>
    </div>
    <div class="certification-body">
        <p>{{ $description }}</p>
    </div>
    <div class="certification-footer">
        <input type="checkbox" name="certification" value="{{ $value }}" id="certification-{{ $value }}">
        <label for="certification-{{ $value }}">Select</label>
    </div>
</div>

<style>
.certification-card { border: 1px solid #ccc; padding: 1rem; margin-bottom: 1rem; }
.certification-header { font-weight: bold; }
.price { color: #1f2937; }
.certification-body { margin-top: 0.5rem; }
.certification-footer { margin-top: 1rem; }
</style>


{{--useded
 <div id="use"><x-certification-card 
    title="ICCA" 
    price="$99" 
    description="The ICCA Certified Cloud Associate certification allows..." 
    value="icca"
/></div> --}}