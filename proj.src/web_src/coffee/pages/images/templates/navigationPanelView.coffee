html = '<div id="navButtons">
  <div id="scrollBack" class="button<% if (firstPage) { %> hidden<%}%>">back </div>
  <div id="scrollForward" class="button<% if (lastPage) { %> hidden<%}%>">forward</div>
  <% for(var i = 1; i <= totalPages; i++){ %>
    <div id="pageButton" page="<%- i%>" class="button pageButton<% if (currentPos === i) { %> current<%}%>"><%- i%></div>
  <% } %>
</div>'

module.exports = html