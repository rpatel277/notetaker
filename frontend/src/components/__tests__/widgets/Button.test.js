import { describe, test, expect } from "vitest";
import { mount } from "@vue/test-utils";

import Button from "@/components/widgets/Button.vue";

describe("Button.vue", () => {
  test("mount component", async () => {
    expect(Button).toBeTruthy();

    const wrapper = mount(Button, {
      props: {
        label: "Button",
        variant: "primary",
      },
    });
    expect(wrapper.text()).toContain("Button");
  });

  test("renders correct variant", () => {
    const variant = "danger";
    const wrapper = mount(Button, {
      props: {
        label: "Button",
        variant: variant,
      },
    });
    expect(wrapper.classes()).toEqual(expect.arrayContaining(["bg-red-500"]));
  });
});
