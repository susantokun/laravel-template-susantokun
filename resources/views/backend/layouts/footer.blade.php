<div class="bg-secondary px-4 py-1.5 text-center">©
    <?php echo date("Y"); ?> <span class="hidden font-bold md:inline-block">{{ $configuration->title }}</span> <span class="inline-block font-bold md:hidden">{{
        $configuration->title_short
        }}</span>
    by {{ $configuration->author }}
</div>
