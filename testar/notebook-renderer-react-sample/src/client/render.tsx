import React, { useState } from "react";
import type { RendererContext } from 'vscode-notebook-renderer';

interface IRenderInfo {
	container: HTMLElement;
	mime: string;
	value: GitHubIssuesValue[];
	context: RendererContext<unknown>;
}

interface GitHubIssuesValue {
	title: string;
	url: string;
	body: string;
}

export const IssuesList: React.FC<{ info: IRenderInfo }> = ({ info }) => {
	const [filter, setFilter] = useState("");
	const filteredIssues = info.value.filter(issue =>
		issue.title.toLowerCase().includes(filter.toLowerCase())
	);

	return (
		<div style={{ fontFamily: 'Segoe UI, Arial, sans-serif', padding: 16 }}>
			<h2 style={{ color: '#4361ee', marginBottom: 8 }}>GitHub Issues</h2>
			<input
				type="text"
				placeholder="Filter by title..."
				value={filter}
				onChange={e => setFilter(e.target.value)}
				style={{ padding: 6, marginBottom: 16, width: '100%', borderRadius: 4, border: '1px solid #ccc' }}
			/>
			<table style={{ width: '100%', borderCollapse: 'collapse', background: '#f8f8f8' }}>
				<thead>
					<tr style={{ background: '#e9ecef' }}>
						<th style={{ textAlign: 'left', padding: 8 }}>Issue</th>
						<th style={{ textAlign: 'left', padding: 8 }}>Description</th>
					</tr>
				</thead>
				<tbody>
					{filteredIssues.length === 0 ? (
						<tr>
							<td colSpan={2} style={{ padding: 12, color: '#888', textAlign: 'center' }}>No issues found.</td>
						</tr>
					) : (
						filteredIssues.map((item, idx) => (
							<tr key={idx} style={{ borderBottom: '1px solid #e0e0e0' }}>
								<td style={{ padding: 8 }}>
									<a href={item.url} target="_blank" rel="noopener noreferrer" style={{ color: '#4361ee', textDecoration: 'none' }}>{item.title}</a>
								</td>
								<td style={{ padding: 8 }}>{item.body}</td>
							</tr>
						))
					)}
				</tbody>
			</table>
		</div>
	);
};

if (module.hot) {
	module.hot.addDisposeHandler(() => {
		// In development, this will be called before the renderer is reloaded. You
		// can use this to clean up or stash any state.
	});
}
