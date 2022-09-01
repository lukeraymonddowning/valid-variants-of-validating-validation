import { onMounted, onUnmounted, ref } from "vue";

const useDragAndDrop = (elementRef) => {
    const events = ["dragenter", "dragover", "dragleave", "drop"];
    const preventDefault = (event) => event.preventDefault();

    const file = ref(null);
    const isBeingDraggedOver = ref(false);

    onMounted(() => {
        events.forEach((event) =>
            document.body.addEventListener(event, preventDefault)
        );
        elementRef.value.addEventListener(
            "dragover",
            () => (isBeingDraggedOver.value = true)
        );
        elementRef.value.addEventListener(
            "dragleave",
            () => (isBeingDraggedOver.value = false)
        );
        elementRef.value.addEventListener("drop", (event) => {
            file.value = event.dataTransfer.files[0];
            isBeingDraggedOver.value = false;
        });
    });

    onUnmounted(() => {
        events.forEach((event) =>
            document.body.removeEventListener(event, preventDefault)
        );
    });

    return { file, isBeingDraggedOver };
};

export { useDragAndDrop };
