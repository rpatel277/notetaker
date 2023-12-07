import { describe, test, expect } from "vitest";
import { mount } from "@vue/test-utils";

import Input from "@/components/widgets/Input.vue";

describe("Input.vue", () => {
  test("mount component", async () => {
    expect(Input).toBeTruthy();

    const wrapper = mount(Input, {
      props: {
        modelValue: null,
        label: "Input",
        placeholder: "Placeholder",
      },
    });

    // Assert that the label and input elements exist
    expect(wrapper.find("label").exists()).toBe(true);
    expect(wrapper.find("input").exists()).toBe(true);

    // Assert default label text
    expect(wrapper.find("span").text()).toBe("Input");
  });

  // Test case 2: Renders input field with custom props
  test("renders input field with custom props", () => {
    const customLabel = "Username";
    const customPlaceholder = "Enter your username";
    const wrapper = mount(Input, {
      props: {
        label: customLabel,
        placeholder: customPlaceholder,
      },
    });

    // Assert custom label text and placeholder
    expect(wrapper.find("span").text()).toBe(customLabel);
    expect(wrapper.find("input").attributes("placeholder")).toBe(customPlaceholder);
  });

  test("updates input value on input event", async () => {
    const wrapper = mount(Input);

    // Simulate input value change
    await wrapper.find("input").setValue("New Value");

    // Assert emitted update:modelValue event
    expect(wrapper.emitted("update:modelValue")).toBeTruthy();
  });

  test("displays error message when error prop is provided", () => {
    const errorMessage = "Invalid input";
    const wrapper = mount(Input, {
      props: {
        error: errorMessage,
      },
    });

    // Assert that the error message is displayed
    expect(wrapper.find("small").text()).toBe(errorMessage);
  });
});
