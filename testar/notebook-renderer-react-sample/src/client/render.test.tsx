jest.config.js
{
  "preset": "@testing-library/react",
  "testEnvironment": "jsdom"
}

src/client/render.test.tsx
import { render, screen } from '@testing-library/react';
import YourComponent from './YourComponent';

test('renders hello world', () => {
  render(<YourComponent />);
  const linkElement = screen.getByText(/hello world/i);
  expect(linkElement).toBeInTheDocument();
});