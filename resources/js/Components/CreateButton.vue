<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

<template>
    <button :type="type" class="inline-flex 
        items-center 
        px-2 py-1 bg-[#71629f] 
        hover:bg-[#5a4e7e]
        border border-transparent 
        rounded-[4px] font-semibold 
        text-xs text-white 
        uppercase tracking-widest 
        focus:bg-[#5f4d95] active:bg-[#5f4d95] 
        focus:outline-none focus:ring-2 
        focus:ring-[#5f4d95] focus:ring-offset-2 
        transition ease-in-out duration-150                
        align-middle mt-1">
        <slot />
    </button>
</template>
